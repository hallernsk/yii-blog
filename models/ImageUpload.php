<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model
{
    public $image;

    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    public function uploadFile(UploadedFile $file, $currentImage = null)
    {
        $this->image = $file;

        if ($this->validate()) {

            $this->deleteCurrentImage($currentImage);

            return $this->saveImage();
        }
    }

    private function getFolder()
    {
        return Yii::getAlias('@web') . 'uploads/';
    }

    private function generateFilename()
    {
        return strtolower(md5(uniqid($this->image->baseName))) . '.' . $this->image->extension;
    }

    public function deleteCurrentImage($currentImage)
    {
        if ($currentImage && $this->fileExists($currentImage)) {
            unlink($this->getFolder() . $currentImage);
        }
    }

    private function fileExists($currentImage)
    {
        if (!empty($currentImage) && !is_null($currentImage)) {
            return file_exists($this->getFolder() . $currentImage);
        }

    }

    private function saveImage()
    {
        $filename = $this->generateFilename();
        $this->image->saveAs($this->getFolder() . $filename) or die('Error');
        return $filename;
    }

    public function deleteImage()
    {
        $imageUploadModel = new ImageUpload();
        $imageUploadModel->deleteCurrentImage($this->image);
    }
}
