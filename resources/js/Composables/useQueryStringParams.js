import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

export function useQueryStringParams() {
    const queryStringParams = computed(() => ({
        // page: usePage().props.ziggy.query?.page,
        per_page: usePage().props.ziggy.query?.per_page,
        sort: usePage().props.ziggy.query?.sort,
        direction: usePage().props.ziggy.query?.direction,
        created_from: usePage().props.ziggy.query?.created_from,
        created_until: usePage().props.ziggy.query?.created_until,
        deleted_from: usePage().props.ziggy.query?.deleted_from,
        deleted_until: usePage().props.ziggy.query?.deleted_until,
        filter_by_status: usePage().props.ziggy.query?.filter_by_status,
    }));

    return {
        queryStringParams,
    };
}
