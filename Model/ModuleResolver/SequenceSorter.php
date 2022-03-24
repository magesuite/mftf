<?php
declare(strict_types=1);

namespace MageSuite\Mftf\Model\ModuleResolver;

class SequenceSorter implements \Magento\FunctionalTestingFramework\Util\ModuleResolver\SequenceSorterInterface
{
    public function sort(array $paths): array
    {
        $this->sortModulePathAtTheEnd($paths, 'creativestyle/magesuite-mftf');
        $this->sortModulePathAtTheEnd($paths, 'creativestyle/customization');

        return $paths;
    }

    protected function sortModulePathAtTheEnd(&$paths, string $modulePath): void
    {
        usort($paths, function ($first, $second) use ($modulePath) { //phpcs:ignore
            if (strpos($first, $modulePath) !== false) {
                return 1;
            }

            if (strpos($second, $modulePath) !== false) {
                return -1;
            }

            return 0;
        });
    }
}
