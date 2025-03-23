export interface Category {
    id: number;
    name: string;
    description?: string;
    created_at: string;
    updated_at: string;
}

export interface Ingredient {
    id: number;
    category_id: string;
    name: string;
    description?: string;
    density?: number;
    unit?: string;
    created_at: string;
    updated_at: string;
}

export interface PaintType {
    id: number;
    name: string;
    description?: string;
    created_at: string;
    updated_at: string;
}

export interface Formula {
    id: number;
    paint_type_id: number;
    ingredient_id: number;
    ratio: number;
    is_required: boolean;
    min_percentage?: number;
    max_percentage?: number;
    created_at: string;
    updated_at: string;
}