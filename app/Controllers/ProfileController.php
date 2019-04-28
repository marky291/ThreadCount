<?php


namespace App\Controllers;


use App\Exceptions\UnauthorizedException;
use App\Models\Roles;
use App\Models\Users;

class ProfileController extends Controller
{
    public function update()
    {
        $this->gates(['auth']);

        if ($this->request->isGetMethod())
        {
            $roles = Roles::all();

            $user = Users::whereUsername($this->request->get('username'))->first();

            $currentUserOwnsProfile = ($user['user_id'] == auth()->user()->getId());

            if ($currentUserOwnsProfile || auth()->user()->hasRole(['super', 'admin', 'moderator']))
            {
                $this->render('profile.update', ['profile' => $user, 'roles' => $roles]);
            }
            else
            {
                throw new UnauthorizedException('Not allowed to edit this profile.');
            }

        }

        $profileID = $this->request->post('profileID');
        $username = $this->request->post('username');
        $email = $this->request->post('email');
        $avatar = $this->request->post('avatarUrl');
        $roleID = $this->request->post('roleID');

        Users::updateDetails($profileID, $email, $username, $avatar, $roleID);

        auth()->logout();

        return redirect('/');
    }

}