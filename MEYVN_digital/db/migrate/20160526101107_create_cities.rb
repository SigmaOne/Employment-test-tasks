class CreateCities < ActiveRecord::Migration[5.0]
  def change
    create_table :cities do |t|
      t.string :name
      t.timestamps null: false
    end

    # Add city_id foreign_key to events
    add_reference :events, :city, index: true, foreign_key: true
  end
end
