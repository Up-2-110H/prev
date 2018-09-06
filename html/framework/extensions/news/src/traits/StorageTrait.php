<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 06.09.18
 * Time: 12:21
 */

namespace krok\news\traits;

use krok\storage\dto\StorageDto;
use yii\web\UploadedFile;

/**
 * Trait StorageTrait
 *
 * @package krok\news\traits
 */
trait StorageTrait
{
    /**
     * @var UploadedFile|StorageDto
     */
    protected $src;

    /**
     * @return string
     */
    public function getModel(): string
    {
        return static::class;
    }

    /**
     * @return int
     */
    public function getRecordId(): int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return null;
    }

    /**
     * @return null|string
     */
    public function getHint(): ?string
    {
        return null;
    }

    /**
     * @param $src
     */
    public function setSrc($src)
    {
        $this->src = $src;
    }

    /**
     * @return StorageDto|UploadedFile
     */
    public function getSrc()
    {
        return $this->src;
    }
}
