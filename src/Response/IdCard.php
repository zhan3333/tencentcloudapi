<?php


namespace Zhan3333\Tencent\Response;


use Zhan3333\Tencent\Request\OCRIdCardRequest;

class IdCard
{
    /** @var  $type
     *
     * 证件类型。
     *
     * 返回1，代表是身份证。
     */
    public $type;

    /**
     * @var string $address 住址
     */
    public $address;

    /** @var  string $gender 性别（男 /女） */
    public $gender;

    /** @var string $id_card_number 身份证号 */
    public $id_card_number;

    /** @var string $name 姓名 */
    public $name;

    /**
     * @var string $side
     * 表示身份证的国徽面或人像面。返回值为：
     *
     * front: 人像面
     *
     * back: 国徽面
     */
    public $side;

    /**
     * @var string 性别
     */
    public $sex;

    /**
     * @var string 民族
     */
    public $nation;

    /**
     * @var string 生日  1992/12/4
     */
    public $birth;

    /**
     * @var string 签发机关
     */
    public $authority;

    /**
     * @var string 有效期
     */
    public $validDate;

    /**
     * 返回是否为身份证
     * @return bool
     */
    public function isCard(): bool
    {
        return $this->type === 1;
    }

    /**
     * 返回是否已为反面
     * @return bool
     */
    public function isBack(): bool
    {
        return $this->side === OCRIdCardRequest::SIDE_BACK;
    }

    /**
     * 返回是否为正面
     * @return bool
     */
    public function isFront(): bool
    {
        return $this->side === OCRIdCardRequest::SIDE_FRONT;
    }
}
