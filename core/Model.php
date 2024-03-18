<?php

namespace app\core;
// Делая класс Model абстрактным я исключаю возможность создания экземпляров этого класса.
//Экземпляры могут быть получены только от подкласса, унаследовавшего класс Model
abstract class Model
{
    //Константы, необходимые для валидации пользовательского ввода при заполнении форм
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    //Массив, в который записываются ошибки. Если массив пуст, то ошибок нет.
    public array $errors = [];

    //--------------------------------------------------------------------------------------------------
    //В классе, произведённом от класса Model есть свойства, имена которых совпадают с ключами соответствующего 
    //массива, полученного после заполнением пользователем формы.
    public function loadData($data)
    { //Пробегаем по массиву. Если в экземпляре дочернего класса есть свойство с именем, совпадающим
        //с ключём массива,то в это свойство записываем значение, соответстующее этому ключу.
        foreach ($data as $key => $value) {
            if (\property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }



    //Абстрактный метод !!!ОБЯЗАТЕЛЬНО ДОЛЖЕН!!! быть реализован в дочернем классе 
    //Возвращает массив с набором правил, соотвествующих каждому свойству , которое
    //представляет собой поле формы.
    abstract public function rules(): array;

    //-------------------------------------------------------------------------------------------------------------------
    //
    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!\is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL && !\filter_var($value, \FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::RULE_EMAIL);
                }
                if ($ruleName === self::RULE_MIN && \strlen($value) < $rule['min']) {
                    $this->addError($attribute, self::RULE_MIN, $rule);
                }
                if ($ruleName === self::RULE_MAX && \strlen($value) > $rule['max']) {
                    $this->addError($attribute, self::RULE_MAX, $rule);
                }
            }
        }
        return empty($this->errors);
    }
    //-----------------------------------------------------------------------------------------------
    public function addError(string $attribute, string $rule, $params = [])
    {
        $message = $this->errorMessages()[$rule] ?? '';
        foreach ($params as $key => $value) {
        $message = \str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }
    //------------------------------------------------------------------------------------------------
    public function errorMessages()
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be valid email address',
            self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_MAX => 'Max length of this field must be {max}',
            self::RULE_MATCH => 'This field must be the same as {match}',

        ];
    }
}
