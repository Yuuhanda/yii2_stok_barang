<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\Url;

class UploadPicture extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, webp, gif', 'maxSize' => 50485760], // Limit to 1MB
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            // Generate a random file name with 3 digits and a timestamp
            $fileName = random_int(100, 999) . '_' . time() . '.' . $this->imageFile->extension;
            $filePath = $this->uploadPath() . '/' . $fileName;

            // Save the uploaded file to the specified path
            if ($this->imageFile->saveAs($filePath)) {
                return $fileName; // Return the filename for storage in the database
            }
        }
        return false;
    }

    protected function uploadPath()
    {
        return Url::to('../web/uploads'); // Directory path for the uploaded files
    }
}
