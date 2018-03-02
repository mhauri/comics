<?php
declare (strict_types=1);

namespace Comics\Lockfile;

class Lockfile
{
    const LOCKFILE_FOLDER_NAME = 'lock';
    const LOCKFILE_FILE_ENDING = 'lock';

    public function isLocked(string $name, string $content)
    {
        $name = strtolower($name);
        $content = sha1($content);
        $lockFileContent = $this->getLockFileContent($name);

        if($lockFileContent === $content) {
            return true;
        }

        $this->wirteLockfile($name, $content);

        return false;
    }

    private function getLockFileContent(string $name)
    {
        if(realpath($this->getLockFilePath($name))) {
            return file_get_contents($this->getLockFilePath($name));
        }
        return '';
    }

    private function getLockFilePath(string $name)
    {
        return sprintf('%s/%s/%s.%s', APP_PATH, self::LOCKFILE_FOLDER_NAME, $name, self::LOCKFILE_FILE_ENDING);
    }

    private function wirteLockfile(string $name, string $content)
    {
        $path = $this->getLockFilePath($name);
        file_put_contents($path, $content);
    }
}
