class DatetimeService {
    static formatDate(date: string, format: string = "yyyy-mm-dd"): string {
        const dateObj = new Date(date);
        const year = dateObj.getFullYear();
        const month = String(dateObj.getMonth() + 1).padStart(2, "0");
        const day = String(dateObj.getDate()).padStart(2, "0");

        let formattedDate: string = format;
        formattedDate = formattedDate.replace("yyyy", String(year));
        formattedDate = formattedDate.replace("mm", month);
        formattedDate = formattedDate.replace("dd", day);

        return formattedDate;
    }

    static formatDateTime(
        date: string,
        format: string = "yyyy-mm-dd HH:MM:ss"
    ): string {
        const dateObj = new Date(date);
        const year = dateObj.getFullYear();
        const month = String(dateObj.getMonth() + 1).padStart(2, "0");
        const day = String(dateObj.getDate()).padStart(2, "0");
        const hours = String(dateObj.getHours()).padStart(2, "0");
        const minutes = String(dateObj.getMinutes()).padStart(2, "0");
        const seconds = String(dateObj.getSeconds()).padStart(2, "0");

        let formattedDateTime: string = format;
        formattedDateTime = formattedDateTime.replace("yyyy", String(year));
        formattedDateTime = formattedDateTime.replace("mm", month);
        formattedDateTime = formattedDateTime.replace("dd", day);
        formattedDateTime = formattedDateTime.replace("HH", hours);
        formattedDateTime = formattedDateTime.replace("MM", minutes);
        formattedDateTime = formattedDateTime.replace("ss", seconds);

        return formattedDateTime;
    }
}

export default DatetimeService;
