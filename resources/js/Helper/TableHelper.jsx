import moment from "moment";

export const COLUMN_TYPE = {
    NO: Symbol('No'),
    DATE: Symbol('DATE'),
    DATETIME: Symbol('DATETIME'),
    STRING: Symbol('STRING'),
    NUMBER: Symbol('NUMBER'),
    LIST: Symbol('LIST'),
}

export const getValueFromColumn = (column, data, index) => {
    switch (column.type) {
        case COLUMN_TYPE.NO:
            return index + 1
        case COLUMN_TYPE.DATE:
            return moment(data[column.data]).format("yyyy-MM-DD")
        case COLUMN_TYPE.DATETIME:
            return moment(data[column.data]).format("yyyy-MM-DD h:mm a")
        case COLUMN_TYPE.LIST:
            return data[column.data].map(d => d[column.key]).toString()
        default:
            return data[column.data]
    }
}
