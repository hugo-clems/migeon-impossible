<?php 

namespace MyfreelanceBundle\Tools;

use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\Util\UserManipulator as Manipulator;

/**
 * Executes some manipulations on the users
 *
 * @author Christophe Coevoet <stof@notk.org>
 * @author Luis Cordova <cordoval@gmail.com>
 */
class UserManipulator extends Manipulator
{

    /**
     * User manager
     *
     * @var UserManagerInterface
     */
    private $userManager;

    public function __construct(UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * Creates a user and returns it.
     *
     * @param string  $username
     * @param string  $password
     * @param string  $email
     * @param Boolean $active
     * @param Boolean $superadmin
     *
     * @return \FOS\UserBundle\Model\UserInterface
     */
    public function create($username, $password, $email, $active, $superadmin)
    {

        $user = $this->userManager->createUser();
        $user->setUsername($username);
        $user->setName($this->name);
        $user->setEmail($email);
        $user->setPlainPassword($password);
        $user->setEnabled((Boolean) $active);
        $this->userManager->updateUser($user, true);

        return $user;
    }
    
    public function createCustomer(){
        
    }

    public function setName($name)
    {
        $this->name = $name;
    }

}