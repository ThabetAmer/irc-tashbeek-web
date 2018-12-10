<?php
/**
 * Created by Solaiman Kmail <psokmail@gmail.com>
 */

namespace App\Sync;


trait CaseVerification
{
    /**
     * @param $type
     * @throws \Throwable
     */
    protected function verifyCaseType($type)
    {
        $types = array_map(function($caseType){
            return $this->getTypeFromClass($caseType);
        },$this->caseTypes);

        throw_unless(
            is_null($type) || in_array($type, $types),
            \InvalidArgumentException::class,
            "Case type is invalid, use one of " . implode(', ', $types)
        );
    }

    /**
     * get case type from class
     *
     * @param $class
     * @return string
     */
    protected function getTypeFromClass($class)
    {
        return kebab_case(class_basename($class));
    }

    /**
     * Get case class from type
     * @param $caseType
     * @return mixed
     */
    protected function getClassFromType($caseType){
        foreach($this->caseTypes as $caseTypeClass){
            if($this->getTypeFromClass($caseTypeClass) === $caseType){
                return $caseTypeClass;
            }
        }
    }
}