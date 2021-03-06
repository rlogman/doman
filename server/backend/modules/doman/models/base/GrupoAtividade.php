<?php

namespace app\modules\doman\models\base;

use Yii;

/**
 * This is the base model class for table "grupo_atividade".
 *
 * @property integer $grupo_id
 * @property integer $atividade_id
 *
 * @property \app\modules\doman\models\Atividade $atividade
 * @property \app\modules\doman\models\Grupo $grupo
 */
class GrupoAtividade extends \yii\db\ActiveRecord
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
            'atividade',
            'grupo'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grupo_id', 'atividade_id', 'ordem'], 'required'],
            [['grupo_id', 'atividade_id', 'ordem'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grupo_atividade';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'grupo_id' => Yii::t('translation', 'Grupo ID'),
            'atividade_id' => Yii::t('translation', 'Atividade ID'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtividade()
    {
        return $this->hasOne(\app\modules\doman\models\Atividade::className(), ['id' => 'atividade_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupo()
    {
        return $this->hasOne(\app\modules\doman\models\Grupo::className(), ['id' => 'grupo_id']);
    }
    }
