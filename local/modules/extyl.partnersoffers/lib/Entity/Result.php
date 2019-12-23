<?php
namespace Extyl\Spasibo\Partners\Entity;

use Bitrix\Main\DB\ArrayResult;
use Bitrix\Main\ORM\Query\Result as BxResult;

class Result extends BxResult
{
    protected $data = [];

    public static function fromBxResult(BxResult $result, $data = [])
    {
        if ( ! $data)
        {
            return $result;
        }

        $array = new ArrayResult($data);

        $self = new static($result->query, $array);
        $self->connection = $result->connection;
        $self->converters = $result->converters;
        $self->count = $result->count;
        $self->fetchDataModifiers = $result->fetchDataModifiers;
        $self->identityMap = $result->identityMap;
        $self->objectClass = $result->objectClass;
        $self->objectInitPassed = $result->objectInitPassed;
        $self->primaryAliases = $result->primaryAliases;
        $self->replacedAliases = $result->replacedAliases;
        $self->resource = $result->resource;
        $self->selectChainsMap = $result->selectChainsMap;
        $self->serializedFields = $result->serializedFields;
        $self->trackerQuery = $result->trackerQuery;

        return $self;
    }
}
