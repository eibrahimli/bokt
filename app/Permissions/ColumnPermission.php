<?php


namespace App\Permissions;


/**
 * Class that represent permission for user to ses certain column
*/
class ColumnPermission
{
  protected $column;
  protected $label;
  protected $nameDefault;
  protected $names;
  protected $path;

  /**
   * Creates new instance
   *
   * @param string $column
   * @param string $nameDefault
   * @param string[] $names
   * @param ?string $label
  */
  public function __construct(string $column, string $nameDefault, array $names = [], ?string $label = null, string $path = 'oral-requests')
  {
    $this->column = $column;
    $this->label = $label ?? $nameDefault;
    $this->nameDefault = $nameDefault;
    $this->names = $names;
    $this->path = $path;
  }

  /**
   * Function to convert object to array
   *
   * @return array
  */
  public function toArray(): array {

    return [
      'column' => $this->column,
      'default' => $this->nameDefault,
      'names' => $this->names,
      'label' => $this->label,
      'path' => $this->path
    ];
  }

  /**
   * Function to get default name
   *
   * @return string
  */
  public function getDefault(): string {

    return $this->nameDefault;
  }

  /**
   * Function to get name by type
   *
   * @param string $type
   *
   * @return string
  */
  public function getName(string $type): string {
    return $this->names[$type] ?? $this->nameDefault;
  }
}
