class TranslationService {
    __(key, replacements = {}) {
        // @ts-ignore
        let translation = window._translations[key] || key;
        Object.keys(replacements).forEach((r) => {
            translation = translation.replace(`:${r}`, replacements[r]);
        });
        return translation;
    }
}

export const translation = new TranslationService();
