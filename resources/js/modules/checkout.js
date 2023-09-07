import { useForm } from "@inertiajs/vue3";

const state = {
    formRules: {
        required: [
            "firstName",
            "lastName",
            "phone",
            "email",
            "deliveryMethod",
            "paymentMethod",
        ],
        email: ["email"],
        phone: ["phone"],
        confirm_phone_code: ["confirm_phone_code"],
    },
    form: useForm({
        firstName: null,
        lastName: null,
        phone: "+38 (",
        email: null,
        paymentMethod: null,
        deliveryMethod: null,
        call_me_back: true,
        deliveryDepartment: null,
        deliveryDepartmentCity: null,
        confirm_phone_code: null,
        city: null,
        street: null,
        flat: null,
        house: null,
    }),
};
const mutations = {
    updateFormProperties(state, formElements = {}) {
        for (const key in formElements) {
            if (Object.prototype.hasOwnProperty.call(state.form, key)) {
                state.form[key] = formElements[key];
            }
        }
    },
    setForm(state, form) {
        if (Object.prototype.hasOwnProperty.call(form, "post")) {
            state.form = form;
        } else {
            state.form = useForm(form);
        }
    },
    removeFormRuleFields(state, { rule, fields }) {
        if (state.formRules[rule]) {
            state.formRules[rule] = state.formRules[rule].filter(
                (field) => !fields.includes(field)
            );
        }
    },
    pushFormRuleFields(state, { rule, fields }) {
        if (!state.formRules[rule]) {
            state.formRules[rule] = [];
        }
        // Ensure we don't add duplicates
        for (let field of fields) {
            if (!state.formRules[rule].includes(field)) {
                state.formRules[rule].push(field);
            }
        }
    },
};

const actions = {
    updateForm({ commit }, form) {
        commit("setForm", form);
    },
    updateFormElements({ commit }, formElements = {}) {
        commit("updateFormProperties", formElements);
    },
    removeFormRules({ commit }, { rule, fields = [] }) {
        commit("removeFormRuleFields", {
            rule,
            fields,
        });
    },
    pushFormRules({ commit }, { rule, fields = [] }) {
        commit("pushFormRuleFields", {
            rule,
            fields,
        });
    },
    resetDeliveryAddressForCourier({ commit, state }) {
        commit("setForm", {
            ...state.form,
            ...{
                city: null,
                street: null,
                house: null,
                flat: null,
            },
        });
    },
};

const getters = {
    form: (state) => state.form,
    formRules: (state) => state.formRules,
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters,
};
