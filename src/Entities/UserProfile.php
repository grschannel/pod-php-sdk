<?php
namespace PasargadIranianBank\Pod\Entities;


class UserProfile
{
    /**
     * @var int
     */
    private $version;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $nickName;
    /**
     * @var int
     */
    private $followingCount;
    /**
     * @var string
     */
    private $profileImage;
    /**
     * @var int
     */
    private $joinDate;
    /**
     * @var int
     */
    private $userId;
    /**
     * @var string
     */
    private $sheba;
    /**
     * @var string
     */
    private $guest;
    /**
     * @var boolean
     */
    private $chatSendEnable;
    /**
     * @var boolean
     */
    private $chatReceiveEnable;
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $ssoId;
    /**
     * @var int
     */
    private $ssoIssuerCode;

    /**
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param int $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getNickName()
    {
        return $this->nickName;
    }

    /**
     * @param string $nickName
     */
    public function setNickName($nickName)
    {
        $this->nickName = $nickName;
    }

    /**
     * @return int
     */
    public function getFollowingCount()
    {
        return $this->followingCount;
    }

    /**
     * @param int $followingCount
     */
    public function setFollowingCount($followingCount)
    {
        $this->followingCount = $followingCount;
    }

    /**
     * @return string
     */
    public function getProfileImage()
    {
        return $this->profileImage;
    }

    /**
     * @param string $profileImage
     */
    public function setProfileImage($profileImage)
    {
        $this->profileImage = $profileImage;
    }

    /**
     * @return int
     */
    public function getJoinDate()
    {
        return $this->joinDate;
    }

    /**
     * @param int $joinDate
     */
    public function setJoinDate($joinDate)
    {
        $this->joinDate = $joinDate;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getSheba()
    {
        return $this->sheba;
    }

    /**
     * @param string $sheba
     */
    public function setSheba($sheba)
    {
        $this->sheba = $sheba;
    }

    /**
     * @return string
     */
    public function getGuest()
    {
        return $this->guest;
    }

    /**
     * @param string $guest
     */
    public function setGuest($guest)
    {
        $this->guest = $guest;
    }

    /**
     * @return bool
     */
    public function isChatSendEnable()
    {
        return $this->chatSendEnable;
    }

    /**
     * @param bool $chatSendEnable
     */
    public function setChatSendEnable($chatSendEnable)
    {
        $this->chatSendEnable = $chatSendEnable;
    }

    /**
     * @return bool
     */
    public function isChatReceiveEnable()
    {
        return $this->chatReceiveEnable;
    }

    /**
     * @param bool $chatReceiveEnable
     */
    public function setChatReceiveEnable($chatReceiveEnable)
    {
        $this->chatReceiveEnable = $chatReceiveEnable;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getSsoId()
    {
        return $this->ssoId;
    }

    /**
     * @param string $ssoId
     */
    public function setSsoId($ssoId)
    {
        $this->ssoId = $ssoId;
    }

    /**
     * @return int
     */
    public function getSsoIssuerCode()
    {
        return $this->ssoIssuerCode;
    }

    /**
     * @param int $ssoIssuerCode
     */
    public function setSsoIssuerCode($ssoIssuerCode)
    {
        $this->ssoIssuerCode = $ssoIssuerCode;
    }
}