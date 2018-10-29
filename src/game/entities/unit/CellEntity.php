<?php

namespace yii2lab\ai\game\entities\unit;

use yii2lab\ai\game\behaviors\ValidateFilter;
use yii2lab\ai\game\entities\PointEntity;
use yii2lab\ai\game\helpers\Matrix;
use yii2lab\domain\BaseEntity;
use yii2lab\domain\exceptions\ReadOnlyException;
use yii2lab\extension\common\helpers\ClassHelper;

/**
 * Class CellEntity
 *
 * @package yii2lab\ai\game\entities\unit
 *
 * @property $color
 * @property $content
 * @property PointEntity $point
 * @property Matrix $matrix
 */
abstract class CellEntity extends BaseEntity {
	
	protected $color;
	protected $content;
	protected $point;
	private $matrix;
	
	public function behaviors() {
		return [
			ValidateFilter::class,
		];
	}
	
	public function fieldType() {
		return [
			'color' => 'integer',
			'point' => PointEntity::class,
		];
	}
	
	public function rules() {
		return [
			[['matrix', 'point'], 'required'],
		];
	}
	
	protected function getMatrix() {
		return $this->matrix;
	}
	
	public function setMatrix($value) {
		if(isset($this->matrix)) {
			throw new ReadOnlyException('Matrix already assigned!');
		}
		ClassHelper::isInstanceOf($value, Matrix::class);
		$this->matrix = $value;
	}
	
}