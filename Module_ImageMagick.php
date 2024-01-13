<?php
namespace GDO\ImageMagick;

use GDO\CLI\Process;
use GDO\Core\GDO_Module;
use GDO\Core\GDT_Path;

final class Module_ImageMagick extends GDO_Module
{

    public function getConfig(): array
    {
        return [
            GDT_Path::make('im_convert_path')->existingFile(),
            GDT_Path::make('im_probe_path')->existingFile(),
        ];
    }

    public function cfgConvertPath(): ?string
    {
        return $this->getConfigVar('im_convert_path');
    }

    public function cfgProbePath(): ?string
    {
        return $this->getConfigVar('im_probe_path');
    }

    public function onInstall(): void
    {
        if (!$this->cfgConvertPath())
        {
            if ($path = Process::commandPath('magick'))
            {
                $this->saveConfigVar('im_convert_path', $path);
            }
        }
    }

}
