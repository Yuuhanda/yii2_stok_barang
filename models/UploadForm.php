<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\Url;


class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;
    

    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xlsx'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            // Define a file path if you want to save it; otherwise, process in memory.
            $fileName = 'bulk_unit' . random_int(100, 999) . '_' . time() . '.' .  $this->file->extension;
            $filePath = $this->uploadPath() . '/' . $fileName;
            
            
            if ($this->file->saveAs($filePath)) {
                return [
                    'fileName' => $fileName,  // Name to store in the database
                    'filePath' => $filePath   // Full path for further processing if needed
                ];
            } // Return the filename for storage in the database
            
        }
        return null;
    }

    protected function uploadPath()
    {
        return Url::to('../web/document'); // Directory path for the uploaded files
    }
}
