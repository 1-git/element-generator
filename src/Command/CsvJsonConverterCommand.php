<?php

declare(strict_types=1);

namespace ElementGenerator\Command;

use ElementGenerator\ContentRenderer\ContentRendererFactory;
use ElementGenerator\DataSaver\DataSaverFactory;
use ElementGenerator\Generator\TreeBuilder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use ElementGenerator\Generator\ElementsGenerator;
use ElementGenerator\InputLoader\InputLoaderFactory;

/**
 * Class CsvJsonConverterCommand
 * @package ElementGenerator\Command
 */
class CsvJsonConverterCommand extends Command
{
    /**
     * @inheritDoc
     */
    protected static $defaultName = 'app:convert';

    /**
     * @var string
     */
    protected static $defaultDescription = 'Elements structure generator';

    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->setDefinition([
                new InputArgument('input-file', InputArgument::OPTIONAL, 'Csv file with input data (placed into the current folder)', 'input.csv'),
                new InputArgument('output-file', InputArgument::OPTIONAL, 'Json file for data save (placed into the current folder)', 'output.json'),
            ])
            ->setHelp(<<<'EOF'
The <info>%command.name%</info> converting a file with silence to a file with segments:
  <info>php %command.full_name%</info>
or
  <info>php %command.full_name% input.csv</info>
or
  <info>php %command.full_name% input.csv output.json</info>

EOF
            );
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $inputFile = getcwd() . '/files/input/' . $input->getArgument('input-file');
        $outputFile = getcwd() . '/files/output/' . $input->getArgument('output-file');

        if (!file_exists($inputFile)) {
            $output->writeln('Place input file in the directory files/input/');
            return 1;
        }

        $inputLoader = InputLoaderFactory::getLoader(InputLoaderFactory::TYPE_CSV, $inputFile);
        $treeBuilder = new TreeBuilder();
        $contentRenderer = ContentRendererFactory::getRenderer(ContentRendererFactory::TYPE_JSON, $outputFile);
        $dataSaver = DataSaverFactory::getSaver(DataSaverFactory::TYPE_FILE, $outputFile);

        (new ElementsGenerator($inputLoader, $treeBuilder, $contentRenderer, $dataSaver))->generate();

        $output->writeln('File was saved');
        return 0;
    }
}
