<?php

declare(strict_types=1);

namespace App\Model\Phone;

use Exception;
use finfo;

class ImageUploader
{
    public const IMAGES_FOLDER = PHONE_IMAGES_FOLDER;

    /**
     * Upload phone image
     *
     * @param Phone $phone
     * @param string $imageTmpName
     * @return void
     * @throws Exception
     */
    public function upload(Phone $phone, string $imageTmpName): void
    {
        $this->checkDirectory();
        $fileName = $this->getUniqueFileName($this->getImageExtension($imageTmpName));
        $filePath = $this->getFilePath($fileName);
        move_uploaded_file($imageTmpName, $filePath);
        $phone->setImageName($fileName);
    }

    /**
     * Try to remove phone image
     *
     * @param Phone $phone
     * @return bool
     */
    public function remove(Phone $phone): bool
    {
        if ($phone->getImageName() === '') {
            return true;
        }
        try {
            $this->checkDirectory();
            $deleted = unlink($this->getFilePath($phone->getImageName()));
            if ($deleted) {
                $phone->setImageName('');
            }
            return $deleted;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Check images directory
     *
     * @return void
     * @throws Exception
     */
    private function checkDirectory(): void
    {
        if (!is_dir($this->getFilePath())) {
            throw new Exception('No such directory');
        }

        if (!is_writable($this->getFilePath())) {
            throw new Exception('directory is not writable');
        }
    }

    private function getUniqueFileName(string $ext): string
    {
        do {
            $fileName = md5(date('Y-m-d H:i:s:u')) . '.' . $ext;
        } while (file_exists($this->getFilePath($fileName)));

        return $fileName;
    }

    private function getFilePath(?string $fileName = null): string
    {
        return $fileName == null
            ? PUBLIC_PATH . DIRECTORY_SEPARATOR . self::IMAGES_FOLDER
            : PUBLIC_PATH . DIRECTORY_SEPARATOR . self::IMAGES_FOLDER . DIRECTORY_SEPARATOR . $fileName;
    }

    /**
     * Get tpm file extension
     *
     * @param string $tmpName
     * @return string
     * @throws Exception
     */
    private function getImageExtension(string $tmpName): string
    {
        $map = ['image/jpeg' => 'jpg', 'image/jpg' => 'jpg', 'image/png' => 'png'];
        $fInfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $fInfo->file($tmpName);
        if ($mimeType !== false && !in_array($mimeType, $map, true)) {
            return $map[$mimeType];
        }
        throw new Exception('get image mime type error or not allowed mime type');
    }

}