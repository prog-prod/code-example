import { translation } from "@/Services/TranslationService.ts";

export const translations = {
    methods: {
        __(key, replacements = {}) {
            return translation.__(key, replacements);
        },
    },
};
