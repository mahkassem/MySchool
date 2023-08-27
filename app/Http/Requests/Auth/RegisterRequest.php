<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:25',
            'last_name' => 'string|max:25',
            'account_type' => 'required|string|in:teacher,student|max:50',
            'subject' => 'required_if:account_type,teacher|string|max:50',
            'major' => 'sometimes|string|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ];
    }

    /**
     * Register user.
     */
    public function register(): User
    {
        DB::beginTransaction();
        try {

            // create user
            $user = User::create([
                'name' => trim("{$this->first_name} {$this->last_name}"),
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);

            // create account according to account type
            switch ($this->account_type) {
                case 'teacher':
                    $user->teacher()->create([
                        'first_name' => $this->first_name,
                        'last_name' => $this->last_name,
                        'subject' => $this->subject,
                    ]);
                    break;
                case 'student':
                    $user->student()->create([
                        'first_name' => $this->first_name,
                        'last_name' => $this->last_name,
                        'major' => $this->major,
                    ]);
                    break;
            }

            // save data
            DB::commit();

            return $user->makeHidden('created_at', 'updated_at');
        } catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            throw $e;
        }
    }
}
