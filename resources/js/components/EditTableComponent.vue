<template> 
    <div>
        <table class="table table-striped table-bordered">
            <tr>
                <th>ルール</th>
                <th>ステージ1</th>
                <th>ステージ2</th>
                <th>ブキ</th>
                <th>XP</th>
                <th></th>
                <th></th>
            </tr>
            <tr v-for="input_data, key in input_datas">
                <td>{{ input_data.rule.rule_name }}</td>
                <td>{{ input_data.stage1.stage_name }}</td>
                <td>{{ input_data.stage2.stage_name }}</td>
                <td>{{ input_data.buki.buki_name }}</td>
                <td>{{ input_data.xp }}</td>
                <td><button type="button" class="editBtn btn btn-info" @click.prevent="switchEditRow">編集</button></td>
                <td><button type="button" class="deleteBtn btn btn-info">削除</button></td>
            </tr>
        </table>
        <edit-record v-if="isShownChildComponent"></edit-record>
    </div>
</template>

<script>
    import ChildComponent from './EditRecordComponent'
    export default {
        components: {
            ChildComponent
        },
        props:["input_datas"],
        data () {
            return {
                isShownChildComponent: false
            }
        },
        methods: {
             switchEditRow () {
                this.isShownChildComponent = !this.isShownChildComponent
             }
        }
    }
</script>
