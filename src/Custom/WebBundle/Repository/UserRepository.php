<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/11/14
 * Time: 17:44
 */

namespace Custom\WebBundle\Repository;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository implements UserLoaderInterface
{
    public function loadUserByUsername($username)
    {
        $result  =  $this->createQueryBuilder('u')
            ->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult();
        if (!empty($result->getPassword)) {
            $result->setPassword(md5($result->getPassword));
        }
        return $result;
    }
}