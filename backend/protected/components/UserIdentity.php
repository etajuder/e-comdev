<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	    private $_id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
   public function authenticate() {
        $user = TbAdmin::model()->findByAttributes(array('username' => $this->username));
        $pass = md5($this->password);
        if ($user === null) { // No user found!
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else if ($user->password !== ($pass)) { // Invalid password!
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else { // Okay!
            $this->errorCode = self::ERROR_NONE;
            $this->setState('nama', $user->username);
            $this->_id = $user->id_admin;
        }
        return !$this->errorCode;
    }

    public function getId() {
        return $this->_id;
    }
}