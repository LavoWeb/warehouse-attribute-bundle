<?php

namespace Lavoweb\Bundle\WarehouseAttributeBundle\Reader;

use Pim\Component\Connector\Reader\File\CsvProductReader as PimCsvProductReader;

/**
 * Fixes CSV reader of the PIM (see PIM-4939)
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2015 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
class CsvProductReader extends PimCsvProductReader
{
    /**
     * Initialize read process by extracting zip if needed, setting CSV options
     * and settings field names.
     */
    protected function initializeRead()
    {
        // TODO mime_content_type is deprecated, use Symfony\Component\HttpFoundation\File\MimeTypeMimeTypeGuesser?
        if ('application/zip' === mime_content_type($this->filePath)) {
            $this->extractZipArchive();
        }

        $this->csv = new \SplFileObject($this->filePath);
        $this->csv->setFlags(
            \SplFileObject::READ_CSV   |
            \SplFileObject::READ_AHEAD |
            \SplFileObject::SKIP_EMPTY
        );
        $this->csv->setCsvControl($this->delimiter, $this->enclosure, $this->escape);
        $this->fieldNames = $this->csv->fgetcsv();
    }
}