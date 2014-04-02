<?php

namespace Novanova\UserAvatar;

use Novanova\Helpers\FS;
use Novanova\EightBitIcon\EightBitIcon;
use Gregwar\Image\Image;

/**
 * Class UserAvatar
 * @package Novanova\UserAvatar
 */
class UserAvatar
{

    /**
     * @param string|null $photo
     * @param string $path
     * @param string|null $sex
     * @return string
     * @throws UserAvatarException
     */
    public static function create($photo, $path, $sex)
    {
        if ($filename = FS::makeFilename($path, 'jpg')) {
            if ($photo) {
                $image = Image::open($photo);
                $image->save($path . DIRECTORY_SEPARATOR . $filename);
            } else {
                $eightBitIcon = new EightBitIcon();
                $eightBitIcon->generate($path . DIRECTORY_SEPARATOR . $filename, $sex);
            }

        } else {
            throw new UserAvatarException;
        }

        return $filename;
    }

} 