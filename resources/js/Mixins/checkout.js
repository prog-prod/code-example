import FormService from "@/Services/FormService.ts";
import { UserService } from "@/Services/UserService.ts";

export default {
    computed: {
        userService() {
            return new UserService(this.user);
        },
        formService() {
            return new FormService();
        },
    },
};
