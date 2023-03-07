<?php
/**
 * @link https://github.com/creocoder/yii2-flysystem
 * @copyright Copyright (c) 2015 Alexander Kochetov
 * @license http://opensource.org/licenses/BSD-3-Clause
 */

namespace nikitakls\flysystem;

use League\Flysystem\Local\LocalFilesystemAdapter;
use Yii;
use yii\base\InvalidConfigException;

/**
 * LocalFilesystem
 *
 * @author Alexander Kochetov <creocoder@gmail.com>
 */
class LocalFilesystem extends Filesystem
{
    /**
     * @var string
     */
    public $path;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->path === null) {
            throw new InvalidConfigException('The "path" property must be set.');
        }

        $this->path = Yii::getAlias($this->path);

        parent::init();
    }

    /**
     * @return LocalFilesystemAdapter
     */
    protected function prepareAdapter()
    {
        return new LocalFilesystemAdapter($this->path);
    }
}
