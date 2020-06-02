<template> 
    <table>
    <th>ルール</th>
    <th>ステージ1</th>
    <th>ステージ2</th>
    <th>ブキ</th>
    <th>XP</th>
    <tr v-for="input_data, key in input_datas">
    <td>{{ input_data.rule.rule_name }}</td>
    <td>{{ input_data.stage1.stage_name }}</td>
    <td>{{ input_data.stage2.stage_name }}</td>
    <td>{{ input_data.buki.buki_name }}</td>
    <td>{{ input_data.xp }}</td>
    </tr>
    </table>
</template>

<script>
    export default {
        props:{
            input_datas:{
            }
        }
    }
</script>
