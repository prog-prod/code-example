import { $request } from "./RequestService";

export class SearchService {
    public search(searchText, preserveScroll = false, options = {}) {
        return $request.send(
            "get",
            route("products.index"),
            {
                search: searchText,
            },
            {
                preserveScroll,
                ...options,
            }
        );
    }
}

export const $search = new SearchService();
