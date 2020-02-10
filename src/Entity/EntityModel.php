<?php


namespace App\Entity;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

abstract class EntityModel
{
    private static $primitiveType = [
        "int", "integer","bool", "boolean", "float", "double", "string", "array", "object", "null"
    ];

    private $entityManager;

    /**
     * @param array $params
     * @param EntityManagerInterface $entityManager
     * @throws \Exception
     */
    public function hydrate(Array $params, EntityManagerInterface $entityManager=null) : void
    {
        if (!empty($entityManager)) {
            $this->entityManager = $entityManager;
        }

        try {
            $reflectionClass = new \ReflectionClass(get_class($this));
            foreach ($params as $prop => $value) {
                // check if property exist
                if ($reflectionClass->hasProperty($prop)) {
                    $reflectionProperty = $reflectionClass->getProperty($prop);

                    if ($reflectionProperty->getType() !== null) {
                        $this->castValue(
                            $value,
                            $reflectionProperty->getType()->getName()
                        );
                    }

                    if ($value === null) {
                        continue;
                    }

                    // set property value
                    if (!$reflectionProperty->isPublic()) {
                        // check if property setter exist
                        $setterMethod = "set" . ucfirst($prop);
                        if (
                            $reflectionClass->hasMethod($setterMethod)
                            && $reflectionClass->getMethod($setterMethod)->isPublic()
                        ) {
                            $this->$setterMethod($value);
                        } else {
                            throw new \Exception(
                                "Could not update" . get_class($this) . " instance properties.
                                          Method " . $setterMethod . "doesn't exist or isn't public."
                            );
                        }

                    } else {
                        $reflectionProperty->setValue($value);
                    }
                }
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }


    private function castValue(&$value, $propType) {
        if (
            !empty($propType)
            && gettype($value) !== $propType
            && in_array($propType, self::$primitiveType)
        ) {
            settype($value, $propType);
        } else {
            if (class_exists($propType)) {
                $emptyObject = new $propType();
                $value = $this->entityManager->getRepository(get_class($emptyObject))->find((int)$value);
            } else {
                $value = null;
            }
        }
    }

}