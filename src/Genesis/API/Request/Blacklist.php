<?php

namespace Genesis\API\Request;

use \Genesis\API\Base as RequestBase;

class Blacklist extends RequestBase
{
    protected $card_number;
    protected $terminal_token;

    public function __construct()
    {
        $this->initConfiguration();
        $this->setRequiredFields();

        $this->setRequestURL('gateway', 'blacklists', false);
    }

    protected function mapToTreeStructure()
    {
        $treeStructure = array (
            'blacklist_request' => array (
                'card_number'       => $this->card_number,
                'terminal_token'    => $this->terminal_token,
            )
        );

        $this->createArrayObject('treeStructure', $treeStructure);
    }

    private function initConfiguration()
    {
        $config = array (
            'url'       => '',
            'port'      => 443,
            'type'      => 'POST',
            'protocol'  => 'https',
            'transport' => 'tls',
        );

        $this->createArrayObject('config', $config);
    }

    private function setRequiredFields()
    {
        $requiredFields = array (
            'card_number',
        );

        $this->createArrayObject('requiredFields', $requiredFields);
    }
}