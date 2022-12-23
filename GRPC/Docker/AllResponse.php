<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: message.proto

namespace GRPC\Docker;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>docker.dto.AllResponse</code>
 */
class AllResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated string repos = 1;</code>
     */
    private $repos;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string[]|\Google\Protobuf\Internal\RepeatedField $repos
     * }
     */
    public function __construct($data = NULL) {
        \GRPC\Docker\GPBMetadata\Message::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>repeated string repos = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getRepos()
    {
        return $this->repos;
    }

    /**
     * Generated from protobuf field <code>repeated string repos = 1;</code>
     * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setRepos($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->repos = $arr;

        return $this;
    }

}

