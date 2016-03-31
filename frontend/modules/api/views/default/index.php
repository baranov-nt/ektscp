<?php
/* @var $this yii\web\View */
$this->title = 'MCM API';
?>
<h1>Документация MCM API</h1>
<table class="table table-condensed" style="margin: 20px 0 0 0;">
    <tr>
        <td class="default text-center">Запрос</td>
        <td class="default text-center">Описание</td>
    </tr>
    <tr>
        <td class="default"><code>/api</code></td>
        <td class="default">Документация API</td>
    </tr>
    <tr>
        <td class="default"><code>/api/get_adv/&lt;api_key&gt/&lt;id_adv&gt</code></td>
        <td class="default">Получение информации об объявлении</td>
    </tr>
    <tr>
        <td class="default"><code>/api/get_advshedule/&lt;api_key&gt/&lt;id_advshedule&gt</code></td>
        <td class="default">Получение информации об элементе расписания</td>
    </tr>
    <tr>
        <td class="default"><code>/api/get_currentadvs/&lt;api_key&gt</code></td>
        <td class="default">Получение списка текущих объявлений терминала</td>
    </tr>
    <tr>
        <td class="default"><code>/api/get_currentass/&lt;api_key&gt</code></td>
        <td class="default">Получение текущего расписания терминала</td>
    </tr>
    <tr>
        <td class="default"><code>/api/get_commands/&lt;api_key&gt</code></td>
        <td class="default">Получение списка команд для терминала</td>
    </tr>
    <tr>
        <td class="default"><code>/api/get_command/&lt;api_key&gt/&lt;id_command&gt</code></td>
        <td class="default">Получение информации о команде</td>
    </tr>
    <tr>
        <td class="default"><code>/api/set_command/&lt;api_key&gt/&lt;id_command&gt?time=yyyy-mm-dd\Thh:mm:ss&status=&lt;status&gt</code></td>
        <td class="default">Обновление команды</td>
    </tr>
</table>
