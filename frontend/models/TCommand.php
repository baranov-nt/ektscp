<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "t_command".
 *
 * @property integer $id_command
 * @property string $command
 * @property string $cParams
 * @property integer $priority
 * @property integer $force
 * @property integer $status
 * @property integer $type
 * @property string $version
 * @property string $create_at
 * @property string $last_run
 * @property integer $terminal
 *
 * @property TTerminal $terminal0
 */
class TCommand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_command';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['command', 'cParams', 'priority', 'force', 'status', 'type'], 'required'],
            [['command', 'cParams', 'version'], 'string'],
            [['priority', 'force', 'status', 'type', 'terminal'], 'integer'],
            [['create_at', 'last_run'], 'safe'],
            [['terminal'], 'exist', 'skipOnError' => true, 'targetClass' => TTerminal::className(), 'targetAttribute' => ['terminal' => 'id_terminal']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_command' => 'Id Command',
            'command' => 'Command',
            'cParams' => 'C Params',
            'priority' => 'Priority',
            'force' => 'Force',
            'status' => 'Status',
            'type' => 'Type',
            'version' => 'Version',
            'create_at' => 'Create At',
            'last_run' => 'Last Run',
            'terminal' => 'Terminal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerminal0()
    {
        return $this->hasOne(TTerminal::className(), ['id_terminal' => 'terminal']);
    }
}
