<?php

namespace DWNotes\App\Models;

use DWNotes\App\Engine\BaseModel;

/**
 * Class User.
 */
class User extends BaseModel
{
    public function auth($username, $hash)
    {
        $is_user = \get_user_by('login', $username);

        if ($is_user) {

            if ($hash === $this->get_hash($is_user)) {

                return $is_user;
            }
        }

        return false;
    }

    /**
     * @param \WP_User $user
     *
     * @return string
     */
    public function get_hash(\WP_User $user)
    {
        return \sha1(\build_query((array) $user));
    }
}
