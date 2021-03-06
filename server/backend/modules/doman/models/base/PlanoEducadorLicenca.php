<?php

namespace app\modules\doman\models\base;

use Yii;

/**
 * This is the base model class for table "plano_educador_licenca".
 *
 * @property integer $plano_id
 * @property integer $educador_id
 * @property integer $licenca_id
 *
 * @property \app\modules\doman\models\Educador $educador
 * @property \app\modules\doman\models\Licenca $licenca
 * @property \app\modules\doman\models\Plano $plano
 */
class PlanoEducadorLicenca extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    private $_rt_softdelete;
    private $_rt_softrestore;

    public function __construct(){
        parent::__construct();
        $this->_rt_softdelete = [
            'deletado' => true,
        ];
        $this->_rt_softrestore = [
            'deletado' => 0,
        ];
    }

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'educador',
            'licenca',
            'plano'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['plano_id', 'educador_id', 'licenca_id'], 'required'],
            [['plano_id', 'educador_id', 'licenca_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plano_educador_licenca';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'plano_id' => Yii::t('translation', 'Plano ID'),
            'educador_id' => Yii::t('translation', 'Educador ID'),
            'licenca_id' => Yii::t('translation', 'Licenca ID'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEducador()
    {
        return $this->hasOne(\app\modules\doman\models\Educador::className(), ['id' => 'educador_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLicenca()
    {
        return $this->hasOne(\app\modules\doman\models\Licenca::className(), ['id' => 'licenca_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlano()
    {
        return $this->hasOne(\app\modules\doman\models\Plano::className(), ['id' => 'plano_id']);
    }
    }
