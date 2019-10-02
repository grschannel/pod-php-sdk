<?php

namespace PasargadIranianBank\Pod\Factories;

use PasargadIranianBank\Pod\Entities\UserProfile;

class UserProfileFactory
{
    /**
     *
     * @param \stdClass $entity
     * @return UserProfile
     */
    public function make(\stdClass $entity)
    {
        $userProfile = new UserProfile();

        $userProfile->setVersion($entity->version);
        $userProfile->setName($entity->name);
        $userProfile->setEmail($entity->email);
        $userProfile->setNickName($entity->nickName);
        $userProfile->setFollowingCount($entity->followingCount);
        $userProfile->setProfileImage($entity->profileImage);
        $userProfile->setJoinDate($entity->joinDate);
        $userProfile->setUserId($entity->userId);
        $userProfile->setSheba($entity->sheba);
        $userProfile->setGuest($entity->guest);
        $userProfile->setChatSendEnable($entity->chatSendEnable);
        $userProfile->setChatReceiveEnable($entity->chatReceiveEnable);
        $userProfile->setUsername($entity->username);
        $userProfile->setSsoId($entity->ssoId);
        $userProfile->setSsoIssuerCode($entity->ssoIssuerCode);

        return $userProfile;
    }
}