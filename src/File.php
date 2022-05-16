<?php

namespace KitsuneCode\Uploader;

use Exception;

/**
 * Class KitsuneCode File
 *
 * @author Enos S. S. Silva <https://github.com/enosfox>
 * @package KitsuneCode\Uploader
 */
class File extends Uploader
{
    /**
     * Allow zip, rar, bzip, pdf, doc, docx, csv, xls, xlsx, ods, odt files
     * @var array allowed file types
     * https://www.freeformatter.com/mime-types-list.html
     */
    protected static $allowTypes = [
        "application/zip",
        'application/x-rar-compressed',
        'application/x-bzip',
        "application/pdf",
        "application/msword",
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
        "text/csv",
        "application/vnd.ms-excel",
        "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
        "application/vnd.oasis.opendocument.spreadsheet",
        "application/vnd.oasis.opendocument.text",
    ];

    /**
     * Allowed extensions to types.
     * @var array
     */
    protected static $extensions = [
        "zip",
        "rar",
        "bz",
        "pdf",
        "doc",
        "docx",
        "csv",
        "xls",
        "xlsx",
        "ods",
        "odt"
    ];

    /**
     * @param array $file
     * @param string $name
     * @return null|string
     * @throws Exception
     */
    public function upload(array $file, string $name): string
    {
        $this->ext = mb_strtolower(pathinfo($file['name'])['extension']);

        if (!in_array($file['type'], static::$allowTypes) || !in_array($this->ext, static::$extensions)) {
            throw new Exception("Not a valid file type or extension");
        }

        $this->name($name);
        move_uploaded_file($file['tmp_name'], "{$this->path}/{$this->name}");
        return "{$this->path}/{$this->name}";
    }
}
