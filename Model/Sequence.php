<?php

namespace Indexiz\OrderLength\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ResourceConnection as AppResource;
use Magento\SalesSequence\Model\Meta;
use Magento\SalesSequence\Model\Sequence as SequenceSequence;
use Magento\Store\Model\ScopeInterface;

class Sequence extends SequenceSequence
{
    const CONFIG_XML_PATH_ORDER_LENGTH = 'indexiz_order/order/length';

    public function __construct(
        Meta $meta,
        AppResource $resource,
        ScopeConfigInterface $scopeConfig,
        $pattern = self::DEFAULT_PATTERN
    ) {
        $digit = (int)$scopeConfig->getValue(
            self::CONFIG_XML_PATH_ORDER_LENGTH,
            ScopeInterface::SCOPE_STORE
        );
        if ($digit > 0 && $digit < 10) {
            $pattern = "%s%'.0" . $digit . "d%s";
        }
        parent::__construct($meta, $resource, $pattern);
    }
}
