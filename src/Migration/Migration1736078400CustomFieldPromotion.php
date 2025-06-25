<?php
declare(strict_types=1);

/*
 * (c) Sebastian Schreier <info@sebastianschreier.de>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sschreier\CustomizingDisplayPromotionsInCheckout\Migration;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Shopware\Core\Defaults;
use Shopware\Core\Framework\Migration\InheritanceUpdaterTrait;
use Shopware\Core\Framework\Migration\MigrationStep;
use Shopware\Core\Framework\Uuid\Uuid;
use Shopware\Core\System\CustomField\CustomFieldTypes;

final class Migration1736078400CustomFieldPromotion extends MigrationStep
{
    use InheritanceUpdaterTrait;

    public const FIELDSET_NAME = 'sschreier_promotion';
    public const CUSTOMFIELD_IMAGE_NAME = 'sschreier_promotion_image';
    public const CUSTOMFIELD_DESCRIPTION_NAME = 'sschreier_promotion_description';

    public function getCreationTimestamp(): int
    {
        return 1736078400;
    }

    /**
     * @throws Exception
     * @throws \Doctrine\DBAL\Driver\Exception
     */
    public function update(Connection $connection): void
    {
        $customFieldSetId = $this->createCustomFieldSet($connection, self::FIELDSET_NAME, '{"label": {"de-DE": "Zusätzliche Einstellungen", "en-GB": "additional settings"}, "translated": true}');

        $this->createCustomField($connection, $customFieldSetId, self::CUSTOMFIELD_IMAGE_NAME, CustomFieldTypes::MEDIA, '{"label": {"de-DE": "Alternatives Bild", "en-GB": "alternative image"}, "componentName": "sw-media-field", "customFieldType": "media", "customFieldPosition": 1}');
        $this->createCustomField($connection, $customFieldSetId, self::CUSTOMFIELD_DESCRIPTION_NAME, CustomFieldTypes::HTML, '{"label": {"de-DE": "Beschreibung", "en-GB": "description"}, "componentName": "sw-text-editor", "customFieldType": "textEditor", "customFieldPosition": 2}');

        $this->createCustomFieldRelation($connection, $customFieldSetId);
    }

    public function updateDestructive(Connection $connection): void
    {
    }

    protected function createCustomFieldSet(Connection $connection, string $name, string $config): string
    {
        $customFieldSetId = Uuid::randomBytes();

        $connection->executeStatement(
            self::getCustomFieldSetSql(),
            [
                'id' => $customFieldSetId,
                'name' => $name,
                'config' => $config,
                'position' => 1,
                'created_at' => self::getDateTimeValue(),
            ]
        );

        return $customFieldSetId;
    }

    protected function createCustomField(Connection $connection, string $customFieldSetId, string $name, string $fieldType, string $config): string
    {
        $customFieldId = Uuid::randomBytes();

        $connection->executeStatement(
            self::getCustomFieldSql(),
            [
                'id' => $customFieldId,
                'name' => $name,
                'fieldType' => $fieldType,
                'config' => $config,
                'set_id' => $customFieldSetId,
                'created_at' => self::getDateTimeValue(),
            ],
        );

        return $customFieldId;
    }

    protected function createCustomFieldRelation(Connection $connection, $customFieldSetId): void
    {
        $customFieldRelationId = Uuid::randomBytes();

        $connection->executeStatement(
            self::getCustomFieldRelationSql(),
            [
                'id' => $customFieldRelationId,
                'set_id' => $customFieldSetId,
                'created_at' => self::getDateTimeValue(),
                'entity_name' => 'promotion'
            ],
        );
    }

    protected static function getCustomFieldSetSql(): string
    {
        return <<<SQL
            INSERT INTO `custom_field_set` (`id`, `name`, `config`, `active`, `app_id`, `position`, `global`, `created_at`, `updated_at`) VALUES
            (:id, :name, :config, 1, NULL, :position, 0, :created_at, NULL);
            SQL;
    }

    public static function getCustomFieldSql(): string
    {
        return <<<SQL
                INSERT INTO `custom_field` (`id`, `name`, `type`, `config`, `active`, `set_id`, `created_at`, `updated_at`, `allow_customer_write`) VALUES
                (:id, :name, :fieldType, :config, 1, :set_id, :created_at, NULL, 1);
            SQL;
    }

    public static function getCustomFieldRelationSql(): string
    {
        return <<<SQL
                INSERT INTO `custom_field_set_relation` (`id`, `set_id`, `entity_name`, `created_at`, `updated_at`) VALUES
                (:id, :set_id, :entity_name, :created_at, NULL);
            SQL;
    }

    protected static function getDateTimeValue(): string
    {
        return (new \DateTime())->format(Defaults::STORAGE_DATE_TIME_FORMAT);
    }
}
