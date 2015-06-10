<?php
/**
 * https://github.com/mojifan/FormModel4Thinkphp	源码
 * 表单验证模型
 */
class FormModel{
	
	private $_validators;//验证器
	
	private  $_errors=array();//错误信息数组
	
	public function __set($name,$value){
		if($name=='attributes'){
			$setter='set'.ucwords($name);
			if(method_exists($this,$setter)){
				return $this->$setter($value);
			}
		}else{
			$this->$name=$value;
		}
		
	}
	
	//设置属性
	public function setAttributes($values)
	{
		if(!is_array($values))
			return;
		$attributes=array_flip($this->getAttributeNames());
		foreach($values as $name=>$value)
		{
			if(isset($attributes[$name])){
				$this->$name=$value;
			}
		}
	}
	//获取属性名
	public function getAttributeNames()
	{
		$attributes=array();
		foreach($this->getValidators() as $validator)
		{
				foreach($validator->attributes as $name)
					$attributes[$name]=true;
		}
		return array_keys($attributes);
	}
	//添加错误信息
	public function addError($attribute,$error)
	{
		$this->_errors[$attribute]=$error;
	}
	//验证规则
	protected  function rules(){
		return array();
	}
	//属性与标签对应关系数组
	protected function attributeLabels()
	{
		return array();
	}
	//验证方法
	public function validate($attributes=null, $clearErrors=true)
	{
			if($clearErrors){
				$this->clearErrors();
			}
			foreach($this->getValidators() as $validator)
			{
				if($this->hasErrors()){
					break;
				}
				$validator->validate($this,$attributes);
			}
			return !$this->hasErrors();
	}
	//获取验证器
	public function getValidators($attribute=null)
	{
		if($this->_validators===null){
			$this->_validators=$this->createValidators();
		}
		$validators=array();
		foreach($this->_validators as $validator)
		{
				if($attribute===null || in_array($attribute,$validator->attributes,true))
					$validators[]=$validator;
		}
		return $validators;
	}
	//创建验证器
	public function createValidators()
	{
		$validators=array();
		foreach($this->rules() as $rule)
		{
			if(isset($rule[0],$rule[1])){  // attributes, validator name
				$validators[]=(Validator::createValidator($rule[1],$this,$rule[0],array_slice($rule,2)));
			}else{
				throw new Exception('无效的验证规则');
			}
		}
		return $validators;
	}
	//获取属性标签
	public function getAttributeLabel($attribute)
	{
		$labels=$this->attributeLabels();
		if(isset($labels[$attribute])){
			return $labels[$attribute];
		}else{
			return $this->generateAttributeLabel($attribute);
		}
	}
	//根据属性名生成属性标签
	public function generateAttributeLabel($name)
	{
		return ucwords(trim(strtolower(str_replace(array('-','_','.'),' ',preg_replace('/(?<![A-Z])[A-Z]/', ' \0', $name)))));
	}
	//是否有错误信息
	public function hasErrors($attribute=null)
	{
		if($attribute===null)
			return $this->_errors!==array();
		else
			return isset($this->_errors[$attribute]);
	}
	//获取错误信息
	public function getErrors($attribute=null)
	{
		if($attribute===null)
			return $this->_errors;
		else
			return isset($this->_errors[$attribute]) ? $this->_errors[$attribute] : array();
	}

	//清理错误信息
	public function clearErrors($attribute=null)
	{
		if($attribute===null)
			$this->_errors=array();
		else
			unset($this->_errors[$attribute]);
	}
}
/**
 * 验证器基类
 */
abstract class Validator{
	//验证器别名
	public static $builtInValidators=array(
			'required'=>'RequiredValidator',
			'match'=>'RegularExpressionValidator',
			'email'=>'EmailValidator',
			'url'=>'UrlValidator',
			'compare'=>'CompareValidator',
			'length'=>'StringValidator',
			'in'=>'RangeValidator',
			'numerical'=>'NumberValidator',
			'type'=>'TypeValidator',
			'boolean'=>'BooleanValidator',
	);

	public $attributes;//要验证的属性列表

	public $message;//用户自定义的错误信息

	abstract protected function validateAttribute($object,$attribute);//验证单个属性
	//创建验证器
	public static function createValidator($name,$object,$attributes,$params=array())
	{
		if(is_string($attributes)){
			$attributes=preg_split('/[\s,]+/',$attributes,-1,PREG_SPLIT_NO_EMPTY);
		}
		if(method_exists($object,$name)){
			$validator=new InlineValidator();
			$validator->attributes=$attributes;
			$validator->method=$name;
			$validator->params=$params;
		}
		else{
			$params['attributes']=$attributes;
			if(isset(self::$builtInValidators[$name])){
				$className=self::$builtInValidators[$name];
			}else{
				throw  new Exception('验证器不存在');
			}
			$validator=new $className;
			foreach($params as $name=>$value){
				$validator->$name=$value;
			}
		}

		return $validator;
	}
	//验证
	public function validate($object,$attributes=null)
	{
		if(is_array($attributes)){
			$attributes=array_intersect($this->attributes,$attributes);
		}else{
			$attributes=$this->attributes;
		}
		foreach($attributes as $attribute)
		{
			if(!$object->hasErrors($attribute)){
				$this->validateAttribute($object,$attribute);
			}
		}
	}
	//添加错误信息
	protected function addError($object,$attribute,$message,$params=array())
	{
		$params['{attribute}']=$object->getAttributeLabel($attribute);
		$object->addError($attribute,strtr($message,$params));
	}
	//判断是否为空
	protected function isEmpty($value,$trim=false)
	{
		return $value===null || $value===array() || $value==='' || $trim && is_scalar($value) && trim($value)==='';
	}
}
//required
class RequiredValidator extends Validator{
	public $requiredValue;

	public $strict=false;//是否严格比较

	public $trim=true;

	protected function validateAttribute($object,$attribute)
	{
		$value=$object->$attribute;
		if($this->requiredValue!==null)
		{
			if(!$this->strict && $value!=$this->requiredValue || $this->strict && $value!==$this->requiredValue)
			{
				$message=$this->message!==null?$this->message:'{attribute} 必须为 '.$this->requiredValue.'.';
				$this->addError($object,$attribute,$message);
			}
		}
		elseif($this->isEmpty($value,$this->trim))
		{
			$message=$this->message!==null?$this->message:'{attribute} 不能为空.';
			$this->addError($object,$attribute,$message);
		}
	}
}
//reg
class RegularExpressionValidator extends Validator{
	
	public $pattern;
	
	public $allowEmpty=true;
	
	public $not=false;

	protected function validateAttribute($object,$attribute)
	{
		$value=$object->$attribute;
		if($this->allowEmpty && $this->isEmpty($value))
			return;
		if($this->pattern===null){
			throw new Exception('pattern属性必须指定一个有效的正则表达式');
		}
		if(is_array($value) ||
		(!$this->not && !preg_match($this->pattern,$value)) ||
		($this->not && preg_match($this->pattern,$value)))
		{
			$message=$this->message!==null?$this->message:'{attribute} 验证失败.';
			$this->addError($object,$attribute,$message);
		}
	}
}
//email
class EmailValidator extends Validator{
	
	public $pattern='/^[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/';
	
	public $fullPattern='/^[^@]*<[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?>$/';
	
	public $allowName=false;
	
	public $checkMX=false;
	
	public $checkPort=false;
	
	public $allowEmpty=true;
	
	protected function validateAttribute($object,$attribute)
	{
		$value=$object->$attribute;
		if($this->allowEmpty && $this->isEmpty($value))
			return;
		if(!$this->validateValue($value))
		{
			$message=$this->message!==null?$this->message:'{attribute} 不是一个正确的电子邮件地址.';
			$this->addError($object,$attribute,$message);
		}
	}

	public function validateValue($value)
	{
		$valid=is_string($value) && strlen($value)<=254 && (preg_match($this->pattern,$value) || $this->allowName && preg_match($this->fullPattern,$value));
		if($valid)
			$domain=rtrim(substr($value,strpos($value,'@')+1),'>');
		if($valid && $this->checkMX && function_exists('checkdnsrr'))
			$valid=checkdnsrr($domain,'MX');
		if($valid && $this->checkPort && function_exists('fsockopen') && function_exists('dns_get_record'))
			$valid=$this->checkMxPorts($domain);
		return $valid;
	}
	protected function checkMxPorts($domain)
	{
		$records=dns_get_record($domain, DNS_MX);
		if($records===false || empty($records))
			return false;
		usort($records,array($this,'mxSort'));
		foreach($records as $record)
		{
			$handle=@fsockopen($record['target'],25);
			if($handle!==false)
			{
				fclose($handle);
				return true;
			}
		}
		return false;
	}
	
	protected function mxSort($a, $b)
	{
		if($a['pri']==$b['pri'])
			return 0;
		return ($a['pri']<$b['pri'])?-1:1;
	}

}
//url
class UrlValidator extends Validator{

	public $pattern='/^{schemes}:\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)/i';

	public $validSchemes=array('http','https');

	public $defaultScheme;

	public $allowEmpty=true;

	protected function validateAttribute($object,$attribute)
	{
		$value=$object->$attribute;
		if($this->allowEmpty && $this->isEmpty($value))
			return;
		if(($value=$this->validateValue($value))!==false)
			$object->$attribute=$value;
		else
		{
			$message=$this->message!==null?$this->message:'{attribute} 不是一个正确的网址.';
			$this->addError($object,$attribute,$message);
		}
	}

	public function validateValue($value)
	{
		if(is_string($value) && strlen($value)<2000)  // make sure the length is limited to avoid DOS attacks
		{
			if($this->defaultScheme!==null && strpos($value,'://')===false)
				$value=$this->defaultScheme.'://'.$value;
			if(strpos($this->pattern,'{schemes}')!==false)
				$pattern=str_replace('{schemes}','('.implode('|',$this->validSchemes).')',$this->pattern);
			else
				$pattern=$this->pattern;

			if(preg_match($pattern,$value))
				return $value;
		}
		return false;
	}
}
//compare
class CompareValidator extends Validator
{

	public $compareAttribute;

	public $compareValue;

	public $strict=false;

	public $allowEmpty=false;

	public $operator='=';

	protected function validateAttribute($object,$attribute)
	{
		$value=$object->$attribute;
		if($this->allowEmpty && $this->isEmpty($value))
			return;
		if($this->compareValue!==null)
			$compareTo=$compareValue=$this->compareValue;
		else
		{
			$compareAttribute=$this->compareAttribute===null ? $attribute.'_repeat' : $this->compareAttribute;
			$compareValue=$object->$compareAttribute;
			$compareTo=$object->getAttributeLabel($compareAttribute);
		}
		switch($this->operator)
		{
			case '=':
			case '==':
				if(($this->strict && $value!==$compareValue) || (!$this->strict && $value!=$compareValue))
					$message=$this->message!==null?$this->message:'{attribute} 必须被重复.';
				break;
			case '!=':
				if(($this->strict && $value===$compareValue) || (!$this->strict && $value==$compareValue))
					$message=$this->message!==null?$this->message:'{attribute} 必须不等于 "{compareValue}".';
				break;
			case '>':
				if($value<=$compareValue)
					$message=$this->message!==null?$this->message:'{attribute} 必须大于 "{compareValue}".';
				break;
			case '>=':
				if($value<$compareValue)
					$message=$this->message!==null?$this->message:'{attribute} 必须大于等于 "{compareValue}".';
				break;
			case '<':
				if($value>=$compareValue)
					$message=$this->message!==null?$this->message:'{attribute} 必须小于 "{compareValue}".';
				break;
			case '<=':
				if($value>$compareValue)
					$message=$this->message!==null?$this->message:'{attribute} 必须小于等于 "{compareValue}".';
				break;
			default:
				throw new Exception('无效的操作符 '.$this->operator);
		}
		if(!empty($message))
			$this->addError($object,$attribute,$message,array('{compareAttribute}'=>$compareTo,'{compareValue}'=>$compareValue));
	}
}
//string length
class StringValidator extends Validator{
	
	public $max;
	
	public $min;
	
	public $is;
	
	public $tooShort;
	
	public $tooLong;
	
	public $allowEmpty=true;
	
	public $encoding;

	protected function validateAttribute($object,$attribute)
	{
		$value=$object->$attribute;
		if($this->allowEmpty && $this->isEmpty($value))
			return;

		if(is_array($value))
		{
			$this->addError($object,$attribute,'{attribute} 验证无效的.');
			return;
		}

		if(function_exists('mb_strlen') && $this->encoding!==false)
			$length=mb_strlen($value, $this->encoding ? $this->encoding : 'UTF-8');
		else
			$length=strlen($value);

		if($this->min!==null && $length<$this->min)
		{
			$message=$this->tooShort!==null?$this->tooShort:'{attribute} 太短了 (最少 {min} 个字符).';
			$this->addError($object,$attribute,$message,array('{min}'=>$this->min));
		}
		if($this->max!==null && $length>$this->max)
		{
			$message=$this->tooLong!==null?$this->tooLong:'{attribute} 太长了 (最多 {max} 个字符).';
			$this->addError($object,$attribute,$message,array('{max}'=>$this->max));
		}
		if($this->is!==null && $length!==$this->is)
		{
			$message=$this->message!==null?$this->message:'{attribute} 长度不正确 (必须 {length} 个字符).';
			$this->addError($object,$attribute,$message,array('{length}'=>$this->is));
		}
	}
}
//range in
class RangeValidator extends Validator{

	public $range;

	public $strict=false;
	
	public $allowEmpty=true;
	
	public $not=false;

	protected function validateAttribute($object,$attribute)
	{
		$value=$object->$attribute;
		if($this->allowEmpty && $this->isEmpty($value))
			return;
		if(!is_array($this->range))
			throw new Exception('"range" 属性必须是一个数组.');
		$result = false;
		if($this->strict)
			$result=in_array($value,$this->range,true);
		else
		{
			foreach($this->range as $r)
			{
				$result=(strcmp($r,$value)===0);
				if($result)
					break;
			}
		}
		if(!$this->not && !$result)
		{
			$message=$this->message!==null?$this->message:'{attribute} 必须在范围之内.';
			$this->addError($object,$attribute,$message);
		}
		elseif($this->not && $result)
		{
			$message=$this->message!==null?$this->message:'{attribute} 必须在范围之外.';
			$this->addError($object,$attribute,$message);
		}
	}
}
//number
class NumberValidator extends Validator{
	
	public $integerOnly=false;
	
	public $allowEmpty=true;
	
	public $max;
	
	public $min;
	
	public $tooBig;
	
	public $tooSmall;
	
	public $integerPattern='/^\s*[+-]?\d+\s*$/';
	
	public $numberPattern='/^\s*[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?\s*$/';


	/**
	 * Validates the attribute of the object.
	 * If there is any error, the error message is added to the object.
	 * @param CModel $object the object being validated
	 * @param string $attribute the attribute being validated
	 */
	protected function validateAttribute($object,$attribute)
	{
		$value=$object->$attribute;
		if($this->allowEmpty && $this->isEmpty($value))
			return;
		if(!is_numeric($value))
		{
			$message=$this->message!==null?$this->message:'{attribute} 必须是一个数字.';
			$this->addError($object,$attribute,$message);
			return;
		}
		if($this->integerOnly)
		{
			if(!preg_match($this->integerPattern,"$value"))
			{
				$message=$this->message!==null?$this->message:'{attribute} 必须是一个整数.';
				$this->addError($object,$attribute,$message);
			}
		}
		else
		{
			if(!preg_match($this->numberPattern,"$value"))
			{
				$message=$this->message!==null?$this->message:'{attribute} 必须是一个数字.';
				$this->addError($object,$attribute,$message);
			}
		}
		if($this->min!==null && $value<$this->min)
		{
			$message=$this->tooSmall!==null?$this->tooSmall:'{attribute} 太小 (最小为 {min}).';
			$this->addError($object,$attribute,$message,array('{min}'=>$this->min));
		}
		if($this->max!==null && $value>$this->max)
		{
			$message=$this->tooBig!==null?$this->tooBig:'{attribute} 太大 (最大为{max}).';
			$this->addError($object,$attribute,$message,array('{max}'=>$this->max));
		}
	}
}
//type
class TypeValidator extends Validator
{
	/**
	 * @var string the data type that the attribute should be. Defaults to 'string'.
	 * Valid values include 'string', 'integer', 'float', 'array'.
	 */
	public $type='string';
	
	public static $typeLabel=array(
		'string'=>'字符串',
		'integer'=>'整数',
		'float'=>'小数',
		'array'=>'数组'
	);
	
	public $allowEmpty=true;

	public $strict=false;

	protected function validateAttribute($object,$attribute)
	{
		$value=$object->$attribute;
		if($this->allowEmpty && $this->isEmpty($value))
			return;

		if(!$this->validateValue($value))
		{
			$message=$this->message!==null?$this->message : '{attribute} 必须是 {type}.';
			$this->addError($object,$attribute,$message,array('{type}'=>self::$typeLabel[$this->type]));
		}
	}

	public function validateValue($value)
	{
		$type=$this->type==='float' ? 'double' : $this->type;
		if($type===gettype($value))
			return true;
		elseif($this->strict || is_array($value) || is_object($value) || is_resource($value) || is_bool($value))
		return false;

		if($type==='integer')
			return (boolean)preg_match('/^[-+]?[0-9]+$/',trim($value));
		elseif($type==='double')
			return (boolean)preg_match('/^[-+]?([0-9]*\.)?[0-9]+([eE][-+]?[0-9]+)?$/',trim($value));

		return false;
	}
}
//boolean
class BooleanValidator extends Validator{
	
	public $trueValue='1';
	
	public $falseValue='0';
	
	public $strict=false;
	
	public $allowEmpty=true;

	protected function validateAttribute($object,$attribute)
	{
		$value=$object->$attribute;
		if($this->allowEmpty && $this->isEmpty($value))
			return;
		if(!$this->strict && $value!=$this->trueValue && $value!=$this->falseValue
		|| $this->strict && $value!==$this->trueValue && $value!==$this->falseValue)
		{
			$message=$this->message!==null?$this->message:'{attribute} 必须为 {true} 或者 {false}.';
			$this->addError($object,$attribute,$message,array(
					'{true}'=>$this->trueValue,
					'{false}'=>$this->falseValue,
			));
		}
	}
}

//inline
class InlineValidator extends Validator{
	public $method;
	
	public $params;
	
	protected function validateAttribute($object,$attribute)
	{
		$method=$this->method;
		$object->$method($attribute,$this->params);
	}
}