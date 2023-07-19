<!-- Moved template to top of file as point of personal preference -->
<template>
    <button :class="classes" @click="to && navigateTo(to)" :disabled="disabled || loading">
        <slot name="before">
            <app-icon v-if="iconLeft" :icon="iconLeft" />
        </slot>
        <span>
            <slot v-if="!loading"></slot>
            <slot v-if="loading" name="loading"></slot>
        </span>
        <app-loading v-if="loading" size="sm" class="inline-block ml-1" />
        <slot name="after">
            <app-icon v-if="iconRight" :icon="iconRight" :lg="iconLarge" />
        </slot>
    </button>
</template>

<!-- Added TypeScript support and some indentation as part of personal preference. -->
<script setup lang="ts">
// Imported required
import { ref, computed } from 'vue'
// Assuming `navigateTo` is a function, import it appropriately.

// Fixed typo when using the `defineProps` API/compiler macro.
const props = defineProps({
    classes: {
        type: Array,
        default: () => []
    },
    disabled: {
        type: Boolean,
        default: false
    },
    iconLeft: String,
    iconRight: String, // Defined iconRight.
    iconLarge: {
        type: Boolean,
        default: false
    },
    loading: {
        type: Boolean,
        default: false
    },
    padding: String, // Added definition/configuration object for padding.
    sm: Boolean,
    text: Boolean,
    to: String, // Added definition/configuration object for 'to'.
    variant: {
        type: String,
        default: 'primary'
    },
})

const buttonType = ref(props.text ? 'btn-text' : 'btn')

const classes = computed(() => {
    let classes = [...props.classes] // Make a copy of props.classes instead of modifying it directly, also, using wrong context with 'this' in Composition API.

    classes.push(buttonType.value)

    if (buttonType.value === 'btn') {
        classes.push('w-full')
    }

    if (props.variant) {
        classes.push(buttonType.value + '--' + props.variant)
    }

    return classes
})
</script>
