import { User } from "./Contracts/User";

export class UserService {
    private readonly user: User;
    public static defaultAvatarURL: string = "images/user.png";

    constructor(user: User) {
        this.user = user;
    }

    getUser() {
        return this.user;
    }

    isPhoneVerified() {
        return this.user ? !!this.user.phone_verified_at : false;
    }

    getAddressOptions() {
        return this.user ? this.user.addresses : [];
    }

    getDefaultAddress() {
        return this.user
            ? this.user.addresses.find((address) => address.default)
            : null;
    }
}
