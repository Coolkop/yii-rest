<?php


namespace Coolkop\Rest\Dto\Response;


class ViolationListResponse extends ErroneousResponse
{
    /**
     * @var ViolationInterface[]
     */
    private $violationList = [];

    /**
     * @return ViolationInterface[]
     */
    public function getViolationList(): array
    {
        return $this->violationList;
    }

    /**
     * @param ViolationInterface[] $violationList
     *
     * @return ViolationListResponse
     */
    public function setViolationList(array $violationList): ViolationListResponse
    {
        $this->violationList = $violationList;

        return $this;
    }
}
