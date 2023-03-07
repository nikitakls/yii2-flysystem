<?php
/**
 * @link https://github.com/creocoder/yii2-flysystem
 * @copyright Copyright (c) 2015 Alexander Kochetov
 * @license http://opensource.org/licenses/BSD-3-Clause
 */

namespace nikitakls\flysystem;

use League\Flysystem\Config;
use League\Flysystem\DirectoryListing;
use League\Flysystem\Filesystem as NativeFilesystem;
use League\Flysystem\FilesystemAdapter;
use yii\base\Component;

/**
 * Filesystem
 *
 * @method bool fileExists(string $location)
 * @method void write(string $location, string $contents, array $config = [])
 * @method void writeStream(string $location, $contents, array $config = [])
 * @method string read(string $location)
 * @method resource readStream(string $location)
 * @method void delete(string $location)
 * @method void deleteDirectory(string $location)
 * @method void createDirectory(string $location, array $config = [])
 * @method DirectoryListing listContents(string $location, bool $deep = false)
 * @method void move(string $source, string $destination, array $config = [])
 * @method void copy(string $source, string $destination, array $config = [])
 * @method int lastModified(string $path)
 * @method int fileSize(string $path)
 * @method string mimeType(string $path)
 * @method void setVisibility(string $path, string $visibility)
 * @method string visibility(string $path)
 *
 * @author Alexander Kochetov <creocoder@gmail.com>
 */
abstract class Filesystem extends Component
{
    /**
     * @var array
     */
    public $config;
    /**
     * @var FilesystemAdapter
     */
    protected $filesystem;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $adapter = $this->prepareAdapter();
        $this->config = $this->config ?? [];
        $this->filesystem = new NativeFilesystem($adapter, $this->config);
    }

    /**
     * @return FilesystemAdapter
     */
    abstract protected function prepareAdapter();

    /**
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->filesystem, $method], $parameters);
    }

    /**
     * @return FilesystemAdapter
     */
    public function getFilesystem()
    {
        return $this->filesystem;
    }
    
}
