interface PaginatorMeta {
    current_page: number;
    from: number;
    last_page: number;
    links: {
        url: string | null;
        label: string;
        active: boolean;
    }[];
    path: string;
    per_page: number;
    to: number;
    total: number;
}


export class Paginator {
    private meta: PaginatorMeta;
    private elements: { [key: number]: string }[] = [];
    private showPages: number = 2;

    constructor(meta: PaginatorMeta,) {
        this.meta = meta;
        this.initElements();
    }

    hasPages(): boolean {
        return this.meta.last_page > 1;
    }

    onFirstPage(): boolean {
        return this.meta.current_page === 1;
    }

    previousPageUrl(): string | null {
        if (this.meta.current_page > 1) {
            return this.meta.links[this.meta.current_page - 2].url;
        }

        return null;
    }

    currentPage(): number {
        return Number(this.meta.current_page);
    }

    nextPageUrl(): string | null {
        if (this.meta.current_page < this.meta.last_page) {
            return this.meta.links[this.meta.current_page + 1].url;
        }

        return null;
    }

    hasMorePages(): boolean {
        return this.meta.current_page < this.meta.last_page;
    }

    private initElements() {
        const from = (this.currentPage() - this.showPages > 0)
            ? this.currentPage() - this.showPages
            : 1
        const to = this.currentPage() + this.showPages < this.meta.last_page
            ? this.currentPage() + this.showPages
            : this.meta.last_page;

        if (this.currentPage() - this.showPages > 1) {
            this.elements.push('...');
        }
        for (let i = from; i <= to; i++) {
            this.elements.push({[i]: `?page=${i}`})
        }

        if (this.currentPage() + this.showPages < this.meta.last_page) {
            this.elements.push('...');
        }
    }
}
