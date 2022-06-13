<template>
    <tr>
        <td>{{ task.id }}</td>
        <td style="width:600px;">{{ task.name }}</td>
        <td>{{ task.due_date }}</td>
        <td>{{ task.prority }}</td>
        <td>
            <button class="btn btn-info text-light btn-sm">Edit</button>
            <button class="btn btn-danger btn-sm">Delete</button>
        </td>
    </tr>
</template>

<script>
export default {
    props: ['task']
}
</script>