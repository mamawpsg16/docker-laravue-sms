<template>
    <input :type="type" :value="modelValue" class="form-control" @input="$emit('update:modelValue', $event.target.value)"/>
</template>
<script>
export default {
  props: {
            modelValue:String,
            type:{
                type:String,
                default:'text'
            }
        },
  emits: ['update:modelValue']
}
</script>

